package com.example.aaddr.test03;

/**
 * Created by aaddr on 26/3/2018.
 */

public class todoList {
    private String critical;
    private String createdBy;
    private String category;
    private  String heading;
    private String date;
    private int image;
    private String status;

    public todoList(String critical, String createdBy, String category, String heading, String date, int image, String status) {
        this.critical = critical;
        this.createdBy = createdBy;
        this.category = category;
        this.heading = heading;
        this.date = date;
        this.image = image;
        this.status = status;

    }

    public String getStatus() {
        return status;
    }

    public int getImage() {
        return image;
    }

    public String getCategory() {
        return category;
    }

    public String getCreatedBy() {
        return createdBy;
    }

    public String getCritical() {
        return critical;
    }

    public String getDate() {
        return date;
    }

    public String getHeading() {
        return heading;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public void setImage(int image) {
        this.image = image;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public void setCreatedBy(String createdBy) {
        this.createdBy = createdBy;
    }

    public void setCritical(String critical) {
        this.critical = critical;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public void setHeading(String heading) {
        this.heading = heading;
    }
}

