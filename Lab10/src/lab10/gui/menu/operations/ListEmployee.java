/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui.menu.operations;

import Lab10.exceptions.OptionNotExistException;
import java.util.List;
import lab10.gui.Menu;
import lab10.gui.TextField;
import lab10.persons.Employee;

/**
 *
 * @author meti
 */
public class ListEmployee implements Operation {

    protected List<Employee> empls;

    public ListEmployee(List<Employee> empls) {
        this.empls = empls;
    }

    @Override
    public Menu execute(Menu menu, Object... obj) throws Exception {
        String str = null;
        for (int i = 0; i < this.empls.size(); i++) {
            System.out.println("Identyfikator: " + i);
            System.out.println(this.empls.get(i).toString());
            str = new TextField("[Enter] - następny\n[Q] - powrót").readLine();
            switch (str) {
                case "":
                    break;
                case "Q":
                    return menu.getParent();
                default:
                    throw new OptionNotExistException(str);
            }
        }

        return menu.getParent();
    }

}
