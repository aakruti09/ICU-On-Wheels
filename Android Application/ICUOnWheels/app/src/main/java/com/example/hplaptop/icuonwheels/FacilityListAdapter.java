package com.example.hplaptop.icuonwheels;

import android.app.Activity;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class FacilityListAdapter extends ArrayAdapter<String> {
    private final Activity context;
    private final String[] fname;
    private final String[] qty;

    public FacilityListAdapter(Activity context, String[] fname, String[] qty){
        super(context,R.layout.fac_layout, fname);

        this.context=context;
        this.fname=fname;
        this.qty=qty;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater=context.getLayoutInflater();
        View rowView=inflater.inflate(R.layout.fac_layout,null,true);

        TextView fnametext=(TextView)rowView.findViewById(R.id.fname_txt);
        TextView qtytext=(TextView)rowView.findViewById(R.id.qty_txt);

        fnametext.setText(fname[position]);
        qtytext.setText(qty[position]);

        return rowView;
    }
}
