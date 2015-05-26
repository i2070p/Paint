/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.persons;

/**
 *
 * @author meti
 */
public abstract class Employee extends Person {

    protected int salary;
    protected String position;

    public Employee(int salary, String position, String firstName, String lastName, String phoneNumber) {
        super(firstName, lastName, phoneNumber);
        this.salary = salary;
        this.position = position;
    }

    public int getSalary() {
        return salary;
    }

    public void setSalary(int salary) {
        this.salary = salary;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

}
