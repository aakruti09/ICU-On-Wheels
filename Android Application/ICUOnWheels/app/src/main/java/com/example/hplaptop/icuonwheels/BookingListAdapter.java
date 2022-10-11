package com.example.hplaptop.icuonwheels;

import android.app.Activity;
import android.content.Context;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class BookingListAdapter extends ArrayAdapter<String> {
    private final Activity context;
    private final String[] id;
    private final String[] hos;
    private final String[] cond;
    private final String[] times;

    public BookingListAdapter(Activity context, String[] id, String[] hos, String[] cond, String[] times){
        super(context,R.layout.booklist_layout, id);

        this.context=context;
        this.id=id;
        this.hos=hos;
        this.cond=cond;
        this.times=times;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater=context.getLayoutInflater();
        View rowView=inflater.inflate(R.layout.booklist_layout,null,true);

        TextView idtext=(TextView)rowView.findViewById(R.id.txt1);
        TextView hostext=(TextView)rowView.findViewById(R.id.txt2);
        TextView condtext=(TextView)rowView.findViewById(R.id.txt3);
        TextView timetext=(TextView)rowView.findViewById(R.id.txt4);

        idtext.setText(id[position]);
        hostext.setText(hos[position]);
        condtext.setText(cond[position]);
        timetext.setText(times[position]);

        return rowView;
    }
}
