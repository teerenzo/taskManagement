package com.example.task_manage;

public class rejectedData {
    String projectName,taskId, title,feedback;
    rejectedData(String projectName, String taskId, String title, String feedback){
        this.projectName=projectName;
        this.taskId=taskId;
        this.title=title;
        this.feedback=feedback;
    }

    public String getProjectName() {
        return projectName;
    }

    public String getTaskId() {
        return taskId;
    }

    public String getTitle() {
        return title;
    }

    public String getFeedback() {
        return feedback;
    }
}
