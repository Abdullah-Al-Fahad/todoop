<?php


class Employee {
    private $name;
    private $salary;

    
    public function __construct($name, $salary) {
        $this->name = $name;
        $this->setSalary($salary); 
    }

   
    public function getSalary() {
        return $this->salary;
    }

   
    public function setSalary($salary) {
        if ($salary < 0) {
            throw new Exception("Salary cannot be negative.");
        }
        $this->salary = $salary;
    }

    
    public function getDetails() {
        return "Employee: $this->name, Salary: $" . $this->getSalary();
    }
}


try {
    $employee = new Employee("Abdullah Al Fahad", 5000);
    echo $employee->getDetails() . "\n"; 

 
    $employee->setSalary(5500);
    echo $employee->getDetails() . "\n"; 

   
    $employee->setSalary(-1000); 

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
