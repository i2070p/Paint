/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.forms;

import lab10.gui.TextField;
import lab10.persons.Director;

/**
 *
 * @author meti
 */
public class DirectorForm extends Form<Director> {

    protected TextField firstName = new TextField("Imię");
    protected TextField lastName = new TextField("Nazwisko");
    protected TextField salary = new TextField("Wynagrodzenie");
    protected TextField phoneNumber = new TextField("Telefon");
    protected TextField dutyAllowance = new TextField("Dodatek służbowy");
    protected TextField dutyCard = new TextField("Karta służbowa");
    protected TextField costsLimit = new TextField("Limit kosztów/miesiąc");

    public DirectorForm(String title) {
        super(title);
    }

    @Override
    public Director process(Director director) {
        System.out.println(this.title);
        director.setFirstName(this.firstName.readText());
        director.setLastName(this.lastName.readText());
        director.setSalary(this.salary.readInt());
        director.setPhoneNumber(this.phoneNumber.readText());
        director.setDutyAllowance(this.dutyAllowance.readInt());
        director.setDutyCard(this.dutyCard.readText());
        director.setCostsLimit(this.costsLimit.readInt());
        return director;
    }

    public static void main(String[] args) {
        DirectorForm tForm = new DirectorForm("Director form");
        Director director = new Director();
        tForm.process(director);
        System.out.println(director.toString());
    }
}
