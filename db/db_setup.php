<?php
require_once 'config.php'; // Include the config file

class DBSetup {
    private $conn;

    public function __construct() {
        // Connect to MySQL without specifying the database initially
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Check if the database exists, if not, create it
        $db_check_query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        if (!$this->conn->query($db_check_query)) {
            die("Error creating database: " . $this->conn->error);
        }

        // Select the database
        $this->conn->select_db(DB_NAME);

        // Now create the tables as needed
        $this->createTables();
    }

    private function createTables() {
        // Check if the 'user' table exists, if not, create it
        $table_check_query = "SHOW TABLES LIKE 'user'";
        $table_check_result = $this->conn->query($table_check_query);

        if ($table_check_result->num_rows === 0) {
            $create_user_table_query = "
                CREATE TABLE IF NOT EXISTS user (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    firstName VARCHAR(50),
                    lastName VARCHAR(50),
                    email VARCHAR(100) UNIQUE,
                    telephone VARCHAR(20) UNIQUE,
                    address VARCHAR(200),
                    password VARCHAR(255),
                    role VARCHAR(10) DEFAULT 'USER'
                )";
            if (!$this->conn->query($create_user_table_query)) {
                die("Error creating user table: " . $this->conn->error);
            }
        }

        // Check if the 'vehicle' table exists, if not, create it
        $table_check_query = "SHOW TABLES LIKE 'vehicle'";
        $table_check_result = $this->conn->query($table_check_query);

        if ($table_check_result->num_rows === 0) {
            $create_vehicle_table_query = "
                CREATE TABLE IF NOT EXISTS vehicle (
                    vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT,
                    vehicle_number VARCHAR(20) UNIQUE,
                    vehicle_type VARCHAR(50),
                    vehicle_model VARCHAR(50),
                    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
                )";
            if (!$this->conn->query($create_vehicle_table_query)) {
                die("Error creating vehicle table: " . $this->conn->error);
            }
        }

        // Check if the 'location' table exists, if not, create it
        $table_check_query = "SHOW TABLES LIKE 'location'";
        $table_check_result = $this->conn->query($table_check_query);

        if ($table_check_result->num_rows === 0) {
            $create_location_table_query = "
                CREATE TABLE IF NOT EXISTS location (
                    location_id INT AUTO_INCREMENT PRIMARY KEY,
                    location_name VARCHAR(100) NOT NULL,
                    capacity INT DEFAULT 0,
                    occupied INT DEFAULT 0,
                    remaining INT DEFAULT 0,
                    status BOOLEAN DEFAULT TRUE,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
        if (!$this->conn->query($create_location_table_query)) {
            die("Error creating location table: " . $this->conn->error);
        }

        // Check if the 'booking' table exists, if not, create it
        $table_check_query = "SHOW TABLES LIKE 'booking'";
        $table_check_result = $this->conn->query($table_check_query);

        if ($table_check_result->num_rows === 0) {
            $create_booking_table_query = "
                CREATE TABLE IF NOT EXISTS booking (
                    booking_id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT,
                    vehicle_id INT,
                    booking_date DATE,
                    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    start_time TIME,
                    end_time TIME,
                    location_id INT,  -- Change this to location_id
                    status BOOLEAN DEFAULT FALSE,
                    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
                    FOREIGN KEY (vehicle_id) REFERENCES vehicle(vehicle_id) ON DELETE CASCADE,
                    FOREIGN KEY (location_id) REFERENCES location(location_id) ON DELETE CASCADE  -- Establish relationship
                )";

            if (!$this->conn->query($create_booking_table_query)) {
                die("Error creating booking table: " . $this->conn->error);
            }
        }
    }

    }

    public function userHasVehicles($userId) {
        // Prepare the SQL query to check if the user has vehicles
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM vehicle WHERE user_id = ?");
        $stmt->bind_param("i", $userId); // Bind the user ID
    
        // Execute the statement
        $stmt->execute();
        $stmt->bind_result($count); // Bind the result to a variable
        $stmt->fetch(); // Fetch the result
    
        // Close the statement
        $stmt->close();
    
        // Return true if the user has vehicles, false otherwise
        return $count > 0;
    }
    

    public function registerUser($data) {
        // Check for duplicate vehicleNo
        $email = $this->conn->real_escape_string($data['email']);
        $duplicate_check_query = "SELECT * FROM user WHERE email='$email'";
        $duplicate_check_result = $this->conn->query($duplicate_check_query);

        if ($duplicate_check_result->num_rows > 0) {
            return "This user already exists.";
        }

        // Prepare insert statement
        $stmt = $this->conn->prepare("INSERT INTO user (firstName, lastName, email, telephone, address, password)
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", 
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['telephone'],
            $data['address'],
            $data['password']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function authenticateUser($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Verify the role
                if ($user['role'] === 'USER') {
                    // Store user information in the session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role']; // Store role in session
                    
                    return true; // Authentication successful
                } else {
                    return "Unauthorized role. Access denied.";
                }
            } else {
                return "Invalid password or email. Please try again.";
            }
        } else {
            return "No user found with that email.";
        }
    }

    public function authenticateAdmin($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Verify the role
                if ($user['role'] === 'ADMIN') {
                    // Store user information in the session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role']; // Store role in session
                    
                    return true; // Authentication successful
                } else {
                    return "Unauthorized role. Access denied.";
                }
            } else {
                return "Invalid password or email. Please try again.";
            }
        } else {
            return "No user found with that email.";
        }
    }

    public function registerVehicle($user_id, $vehicle_number, $vehicle_type, $vehicle_model) {
        // Check for duplicate vehicle number
        $vehicle_number = $this->conn->real_escape_string($vehicle_number);
        $duplicate_check_query = "SELECT * FROM vehicle WHERE vehicle_number='$vehicle_number'";
        $duplicate_check_result = $this->conn->query($duplicate_check_query);

        if ($duplicate_check_result->num_rows > 0) {
            $vehicle = $duplicate_check_result->fetch_assoc();
            $_SESSION['vehicle_id'] = $vehicle['vehicle_id'];
            return "This vehicle number is already registered.";
        }

        // Prepare insert statement
        $stmt = $this->conn->prepare("INSERT INTO vehicle (user_id, vehicle_number, vehicle_type, vehicle_model) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $vehicle_number, $vehicle_type, $vehicle_model);

        if ($stmt->execute()) {
            $vehicle_id = $stmt->insert_id; // Get the ID of the newly inserted vehicle
            $_SESSION['vehicle_id'] = $vehicle_id; // Set vehicle_id to session
            return true; // Vehicle registered successfully
        } else {
            return "Error: " . $this->conn->error; // Return error
        }
    }

    public function registerBooking($vehicle_id, $date, $start_time, $end_time, $location_id) {
        // Prepare the insert statement
        $stmt = $this->conn->prepare("INSERT INTO booking (user_id, vehicle_id, booking_date, start_time, end_time, location_id) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Use session user_id for user
        $user_id = $_SESSION['user_id'];
        
        // Bind the parameters (note that we don't bind $status anymore)
        $stmt->bind_param("iissss", $user_id, $vehicle_id, $date, $start_time, $end_time, $location_id);
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Booking registered successfully
        } else {
            return "Error: " . $this->conn->error; // Return error
        }
    }
    
    
    public function getAllBookings() {
        $sql = "
            SELECT 
                booking.booking_id,
                booking.booking_date,
                booking.booking_time,
                booking.start_time,
                booking.end_time,
                location.location_name,
                booking.status,
                user.id AS user_id,
                user.firstName,
                user.lastName,
                user.email,
                user.telephone,
                vehicle.vehicle_id,
                vehicle.vehicle_number,
                vehicle.vehicle_type,
                vehicle.vehicle_model
            FROM 
                booking
            JOIN 
                user ON booking.user_id = user.id
            JOIN 
                location ON booking.location_id = location.location_id
            JOIN 
                vehicle ON booking.vehicle_id = vehicle.vehicle_id
        ";
    
        $result = $this->conn->query($sql);
    
        $bookings = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
        }
        
        return $bookings;
    }
    
    public function getUserBookings($userId) {
        $stmt = $this->conn->prepare("
            SELECT 
                booking.booking_id,
                booking.booking_date,
                booking.booking_time,
                booking.start_time,
                booking.end_time,
                location.location_name,
                booking.status,
                vehicle.vehicle_id,
                vehicle.vehicle_number,
                vehicle.vehicle_type,
                vehicle.vehicle_model
            FROM 
                booking
            JOIN 
                vehicle ON booking.vehicle_id = vehicle.vehicle_id
            JOIN 
                location ON booking.location_id = location.location_id
            WHERE 
                booking.user_id = ?
        ");
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $bookings = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
        }
        
        return $bookings;
    }
    
    // Method to get all locations
    public function getAllLocations() {
        $locations = []; // Array to hold location data

        // SQL query to fetch all records from the location table
        $query = "SELECT * FROM location";
        $result = $this->conn->query($query);

        // Check if the query was successful
        if ($result) {
            // Fetch all results into an associative array
            while ($row = $result->fetch_assoc()) {
                $locations[] = $row; // Add each row to the locations array
            }
            $result->free(); // Free the result set
        } else {
            die("Error retrieving locations: " . $this->conn->error);
        }

        return $locations; // Return the array of locations
    }

    public function getAllLocationsWithIdName() {
        // Example implementation
        $sql = "SELECT location_id, location_name FROM location"; // Adjust the table name accordingly
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return []; // Return an empty array if no locations found
    }
    

    public function addLocation($location_name, $capacity) {
        // Prepare SQL to insert new location
        $insert_query = "INSERT INTO location (location_name, capacity, occupied, remaining)
                         VALUES (?, ?, 0, ?)";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($insert_query);
        if (!$stmt) {
            return "Error preparing statement: " . $this->conn->error;
        }
    
        $remaining = $capacity; // Initially, remaining capacity is equal to total capacity

        // Bind parameters
        $stmt->bind_param("sii", $location_name, $capacity, $remaining);
        
        // Execute the statement and check for errors
        if ($stmt->execute()) {
            return true; // Return true for successful execution
        } else {
            return "Error adding location: " . $stmt->error; // Return error message
        }
    }

    public function getBookingById($booking_id) {
        $stmt = $this->conn->prepare("SELECT location_id FROM booking WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function approveBooking($booking_id) {
        $stmt = $this->conn->prepare("UPDATE booking SET status = TRUE WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
    }

    public function updateLocationOccupancy($location_id) {
        // Increment occupied and decrement remaining
        $stmt = $this->conn->prepare("UPDATE location SET occupied = occupied + 1, remaining = remaining - 1 WHERE location_id = ?");
        $stmt->bind_param("i", $location_id);
        $stmt->execute();
        
        // Check if remaining is 0 and update status to false
        $stmt = $this->conn->prepare("UPDATE location SET status = IF(remaining = 0, FALSE, status) WHERE location_id = ?");
        $stmt->bind_param("i", $location_id);
        $stmt->execute();
    }
       

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
