package com.example.my_app;

public class User {

    private int id;
    private String nic, email, locatioin;

    public User(int id, String nic, String email, String locatioin) {
        this.id = id;
        this.nic = nic;
        this.email = email;
        this.locatioin = locatioin;
    }

    public int getId() {
        return id;
    }

    public String getNic() {
        return nic;
    }

    public String getEmail() {
        return email;
    }

    public String getLocatioin() {
        return locatioin;
    }

}
