/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui.menu.operations;

import Lab10.exceptions.OptionNotExistException;
import java.util.List;
import java.util.Scanner;
import lab10.forms.DirectorForm;
import lab10.forms.TraderForm;
import lab10.gui.Menu;
import lab10.gui.TextField;
import lab10.persons.Director;
import lab10.persons.Employee;
import lab10.persons.EmployeeFactory;
import lab10.persons.Trader;

/**
 *
 * @author meti
 */
public class AddEmployee implements Operation {

    protected List<Employee> empls;

    public AddEmployee(List<Employee> empls) {
        this.empls = empls;
    }

    @Override
    public Menu execute(Menu menu, Object... obj) throws Exception {

        String str = new TextField("[D]yrektor/[H]handlowiec").readText();

        Employee emp = EmployeeFactory.create(str);
        switch (str) {
            case "H":
                Trader trader = (Trader) emp;
                TraderForm tForm = new TraderForm("Trader form");
                tForm.process(trader);
                break;
            case "D":
                Director director = (Director) emp;
                DirectorForm dForm = new DirectorForm("Director form");
                dForm.process(director);
                break;
            default:
                throw new OptionNotExistException(str);
        }

        str = new TextField("[Enter] - zapisz\n[Q] - porzuć").readLine();

        switch (str) {
            case "":
                this.empls.add(emp);
                break;
            case "Q":
                return menu.getParent();
            default:
                throw new OptionNotExistException(str);
        }

        return menu.getParent();
    }

}
