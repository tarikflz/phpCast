# phpCast
Casting custom classes to another one what does it mean ? In php we cannot use custom classes for casting
for example 
~~~php
$intVal = (integer) "12345"; //This is ok for php
$user = new User();
$user->id = 12345;
$supervisor = (Supervisor) $user; // This is not ok for php
~~~
Thats why i need to use a trait for casting operation it can be useable whole project.
# Code Example

~~~php
class User{
    public $userId;
    public $password;
}
class Supervisor extends User{
    use TCast;
    public $salary;
}

$user = new User();
$user->userId = 12345;
$user->password = 54321;

$manager = Supervisor::cast($user);
echo $manager->id; //It will return 12345;
~~~