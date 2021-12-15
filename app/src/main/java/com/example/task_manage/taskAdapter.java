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
import java.util.zip.Inflater;

public class taskAdapter extends ArrayAdapter<setData> {
    Context context;
    int resource;
    List<setData> setData;

    public taskAdapter(Context context, int resource, List<setData> setData) {
        super(context, resource, setData);

        this.context = context;
        this.resource = resource;
        this.setData = setData;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater layoutInflater = LayoutInflater.from(context);
        View view = layoutInflater.inflate(resource, null, false);
        TextView title = view.findViewById(R.id.task_title);
        TextView time = view.findViewById(R.id.task_time);
        TextView deadLine = view.findViewById(R.id.task_deadline);
        setData newSetData = setData.get(position);
        title.setText(newSetData.getTitle());
        time.setText(newSetData.getDate());
        deadLine.setText(newSetData.getDeadLine());
        return view;
    }
}
