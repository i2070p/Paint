/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui.menu.operations;

import lab10.gui.Menu;

/**
 *
 * @author meti
 */
public interface Operation {

    public Menu execute(Menu menu, Object... obj) throws Exception;
}