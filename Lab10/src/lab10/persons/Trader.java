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
public class Trader extends Employee {

    protected int provision;
    protected int provisionLimit;

    public Trader(int provision, int provisionLimit, int salary, String firstName, String lastName, String phoneNumber) {
        super(salary, "Handlowiec", firstName, lastName, phoneNumber);
        this.provision = provision;
        this.provisionLimit = provisionLimit;
    }

    public Trader() {
        super(0, "Handlowiec", null, null, null);
        this.provision = 0;
        this.provisionLimit = 0;
    }

    public int getProvision() {
        return provision;
    }

    public void setProvision(int provision) {
        this.provision = provision;
    }

    public int getProvisionLimit() {
        return provisionLimit;
    }

    public void setProvisionLimit(int provisionLimit) {
        this.provisionLimit = provisionLimit;
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Imię").append(": ").append(this.firstName).append("\n");
        sb.append("Nazwisko").append(": ").append(this.lastName).append("\n");
        sb.append("Wynagrodzenie").append(": ").append(this.salary).append("\n");
        sb.append("Stanowisko").append(": ").append(this.position).append("\n");
        sb.append("Telefon").append(": ").append(this.phoneNumber).append("\n");
        sb.append("Prowizja").append(": ").append(this.provision).append("\n");
        sb.append("Limit prowizji/miesiąc").append(": ").append(this.provisionLimit).append("\n");
        return sb.toString();
    }

}
