package com.example.task_manage;

public class setData {
    String projectName,taskId, date, title, description, tech, deadLine, earn;

    setData(String projectName,String taskId, String date, String title, String description, String tech, String deadLine, String earn) {
        this.projectName=projectName;
        this.taskId = taskId;
        this.date = date;
        this.title = title;
        this.description = description;
        this.tech = tech;
        this.deadLine = deadLine;
        this.earn = earn;
    }

    public String getProjectName() {
        return projectName;
    }

    public String getTaskId() {
        return taskId;
    }

    public String getDate() {
        return date;
    }

    public String getTitle() {
        return title;
    }

    public String getDescription() {
        return description;
    }

    public String getTech() {
        return tech;
    }

    public String getDeadLine() {
        return deadLine;
    }

    public String getEarn() {
        return earn;
    }
}
