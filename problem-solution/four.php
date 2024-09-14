<?php


class Animal {
    
    public function makeSound() {
        return "Any kind of sound";
    }
}


class Dog extends Animal {
    public function makeSound() {
        return "gheu! gheu!";
    }
}


class Cat extends Animal {
    public function makeSound() {
        return "Meow! Meow!";
    }
}

class Cow extends Animal {
    public function makeSound() {
        return "hamba! hamba!";
    }
}


function printAnimalSound(Animal $animal) {
    echo $animal->makeSound() . "\n";
}


$dog = new Dog();
$cat = new Cat();
$cow = new Cow();

printAnimalSound($dog);  
printAnimalSound($cat);  
printAnimalSound($cow); 

?>
