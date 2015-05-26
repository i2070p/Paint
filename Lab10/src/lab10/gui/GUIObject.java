/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui;

import lab10.gui.menu.operations.Operation;

/**
 *
 * @author meti
 */
public abstract class GUIObject {

    protected Operation opr;

    public GUIObject(Operation opr) {
        this.opr = opr;
    }


}
