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
public class RemoveEmployee implements Operation {

    protected List<Employee> empls;

    public RemoveEmployee(List<Employee> empls) {
        this.empls = empls;
    }

    @Override
    public Menu execute(Menu menu, Object... obj) throws Exception {

        int id = new TextField("Podaj identyfikator: ").readInt();

        if (!(id >= 0 && id < this.empls.size())) {
            throw new OptionNotExistException(id);
        }

        System.out.println(this.empls.get(id).toString());

        String str = new TextField("[Enter] - zapisz\n[Q] - porzuć").readLine();

        switch (str) {
            case "":
                this.empls.remove(id);
                break;
            case "Q":
                return menu.getParent();
            default:
                throw new OptionNotExistException(str);
        }

        return menu.getParent();
    }

}
