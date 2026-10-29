<?php
class Client {
    private $conn;
    public function __construct($conn) { $this->conn = $conn; }
    public function getAll() {
        $query = "SELECT * FROM clients ORDER BY client_id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add($first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email) {
        $query = "INSERT INTO clients (first_name, last_name, gender, birth_date, contact_number, address, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email]);
    }
    public function update($client_id, $first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email) {
        $query = "UPDATE clients SET first_name = ?, last_name = ?, gender = ?, birth_date = ?, contact_number = ?, address = ?, email = ? WHERE client_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$first_name, $last_name, $gender, $birth_date, $contact_number, $address, $email, $client_id]);
    }
    public function delete($client_id) {
        $query = "DELETE FROM clients WHERE client_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$client_id]);
    }
    public function search($keyword) {
        $keyword = "%" . $keyword . "%";
        $query = "SELECT * FROM clients WHERE first_name LIKE ? OR last_name LIKE ? OR gender LIKE ? OR birth_date LIKE ? OR contact_number LIKE ? OR address LIKE ? OR email LIKE ? ORDER BY client_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>