<?php 
  class Opposition {
    // DB stuff
    private $conn;
    private $table = 'oppositions';

    // Opposition Properties
    public $id;
    public $opposants;
    public $defendeurs;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get opposition
    public function read() {
      // Create query
      $query = 'SELECT defendeurs, opposants FROM ' . $this->table . ' ORDER BY id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Opposition
    public function read_single() {
          // Create query
          $query = 'SELECT defendeurs, opposants FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
         
          $this->opposants = $row['opposants'];
          $this->defendeurs = $row['defendeurs'];
    }

    // Create Opposition
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET opposants = :opposants, defendeurs = :defendeurs';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          
          $this->defendeurs = htmlspecialchars(strip_tags($this->defendeurs));
          $this->opposants = htmlspecialchars(strip_tags($this->opposants));

          // Bind data
         
          $stmt->bindParam(':defendeurs', $this->defendeurs);
          $stmt->bindParam(':opposants', $this->opposants);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Opposition
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET defendeurs = :defendeurs, opposants = :opposants
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
         
          $this->defendeurs = htmlspecialchars(strip_tags($this->defendeurs));
          $this->opposants = htmlspecialchars(strip_tags($this->opposants));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          
          $stmt->bindParam(':defendeurs', $this->defendeurs);
          $stmt->bindParam(':opposants', $this->opposants);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Opposition
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }