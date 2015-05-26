/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui;

import Lab10.exceptions.OptionNotExistException;
import com.sun.org.apache.bcel.internal.generic.InstructionConstants;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import lab10.gui.menu.operations.Operation;

/**
 *
 * @author meti
 */
public class Menu extends GUIObject {

    protected String name;
    private final List<Menu> children;
    private Menu parent;

    public Menu(String name) {
        super(null);
        this.name = name;
        this.children = new ArrayList<>();
    }

    public Menu(String name, Operation opr) {
        super(opr);
        this.name = name;
        this.children = new ArrayList<>();
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    protected Menu action(Object... objs) throws Exception {

        if (this.opr != null) {
            return this.opr.execute(this, objs);
        }

        return this;
    }

    public Menu getParent() {
        return parent;
    }

    public void setParent(Menu parent) {
        this.parent = parent;
    }

    public boolean addSubMenu(Menu menu) {
        menu.parent = this;
        return this.children.add(menu);
    }

    public int getNumberOfItems() {
        return this.children.size();
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();

        sb.append(this.name).append(":").append("\n");

        for (int i = 0; i < this.children.size(); i++) {
            sb.append(" ").append(i).append(". ").append(this.children.get(i).toString());
        }

        return sb.toString();
    }

    public Menu process(Object... objs) throws OptionNotExistException, Exception {
        System.out.println(this.toString());
        Scanner sc = new Scanner(System.in);
        int id = sc.nextInt();
        if (!(id >= 0 && id < this.children.size())) {
            throw new OptionNotExistException(id);
        }
        return this.children.get(id).action(objs);
    }

    public static void main(String[] args) {
        Menu root = new Menu("root");

        Menu item2 = new Menu("item2");

        root.addSubMenu(new Menu("item1"));
        root.addSubMenu(item2);
        root.addSubMenu(new Menu("item3"));

        System.out.println(root.toString());
    }
}
