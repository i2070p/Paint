/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.forms;

/**
 *
 * @author meti
 * @param <T>
 */
public abstract class Form<T> {

    protected String title;

    public Form(String title) {
        this.title = title;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public abstract T process(T obj);
}
