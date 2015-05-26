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
public class Director extends Employee {

    protected String dutyCard;
    protected int dutyAllowance;
    protected int costsLimit;

    public Director(int dutyAllowance, String dutyCard, int costsLimit, int salary, String firstName, String lastName, String phoneNumber) {
        super(salary, "Dyrektor", firstName, lastName, phoneNumber);
        this.dutyAllowance = dutyAllowance;
        this.dutyCard = dutyCard;
        this.costsLimit = costsLimit;
    }

    public Director() {
        super(0, "Dyrektor", null, null, null);
        this.dutyAllowance = 0;
        this.dutyCard = null;
        this.costsLimit = 0;
    }

    public String getDutyCard() {
        return dutyCard;
    }

    public void setDutyCard(String dutyCard) {
        this.dutyCard = dutyCard;
    }

    public int getDutyAllowance() {
        return dutyAllowance;
    }

    public void setDutyAllowance(int dutyAllowance) {
        this.dutyAllowance = dutyAllowance;
    }

    public int getCostsLimit() {
        return costsLimit;
    }

    public void setCostsLimit(int costsLimit) {
        this.costsLimit = costsLimit;
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Imię").append(": ").append(this.firstName).append("\n");
        sb.append("Nazwisko").append(": ").append(this.lastName).append("\n");
        sb.append("Wynagrodzenie").append(": ").append(this.salary).append("\n");
        sb.append("Stanowisko").append(": ").append(this.position).append("\n");
        sb.append("Telefon").append(": ").append(this.phoneNumber).append("\n");
        sb.append("Dodatek służbowy").append(": ").append(this.dutyAllowance).append("\n");
        sb.append("Karta służbowa nr").append(": ").append(this.dutyCard).append("\n");
        sb.append("Limit kosztów/miesiąc").append(": ").append(this.costsLimit).append("\n");
        return sb.toString();
    }
}
