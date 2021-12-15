package com.example.task_manage;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.List;

public class rejectedAdapter extends ArrayAdapter<rejectedData> {
    Context context;
    int resource;
    List<rejectedData> rejectedData;

    public rejectedAdapter(Context context, int resource, List<rejectedData> rejectedData) {
        super(context, resource, rejectedData);

        this.context = context;
        this.resource = resource;
        this.rejectedData = rejectedData;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater layoutInflater = LayoutInflater.from(context);
        View view = layoutInflater.inflate(resource, null, false);
        TextView title = view.findViewById(R.id.rejected_title);
//        TextView time = view.findViewById(R.id.task_time);
//        TextView deadLine = view.findViewById(R.id.task_deadline);
        rejectedData newRejectedDate = rejectedData.get(position);
        title.setText(newRejectedDate.getTitle());
//        time.setText(newSetData.getDate());
//        deadLine.setText(newSetData.getDeadLine());
        return view;
    }
}
