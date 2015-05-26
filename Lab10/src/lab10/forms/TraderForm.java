/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.forms;

import lab10.gui.TextField;
import lab10.persons.Trader;

/**
 *
 * @author meti
 */
public class TraderForm extends Form<Trader> {

    protected TextField firstName = new TextField("Imię");
    protected TextField lastName = new TextField("Nazwisko");
    protected TextField salary = new TextField("Wynagrodzenie");
    protected TextField phoneNumber = new TextField("Telefon");
    protected TextField provision = new TextField("Prowizja");
    protected TextField provisionLimit = new TextField("Limit prowizji/miesiąc");

    public TraderForm(String title) {
        super(title);
    }

    @Override
    public Trader process(Trader trader) {
        System.out.println(this.title);
        trader.setFirstName(this.firstName.readText());
        trader.setLastName(this.lastName.readText());
        trader.setSalary(this.salary.readInt());
        trader.setPhoneNumber(this.phoneNumber.readText());
        trader.setProvision(this.provision.readInt());
        trader.setProvisionLimit(this.provisionLimit.readInt());
        return trader;
    }

    public static void main(String[] args) {
        TraderForm tForm = new TraderForm("Trader form");
        Trader trader = new Trader();
        tForm.process(trader);
        System.out.println(trader.toString());
    }
}
