package com.example.hplaptop.icuonwheels;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ExpandableListView;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public class Clinic_List extends AppCompatActivity {

    private ExpandableListView listView;
    private ExpandableListAdapter listAdapter;
    private List<String> listDataHeader;
    private HashMap<String,List<String>> listHash;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_clinic__list);

        listView=(ExpandableListView)findViewById(R.id.lvExp);
        initData();
        listAdapter=new ExpandableListAdapter(this,listDataHeader,listHash);
        listView.setAdapter(listAdapter);
    }
    private void initData() {
        listDataHeader=new ArrayList<>();
        listHash= new HashMap<>();

        listDataHeader.add("Zydus Hospital");
        listDataHeader.add("CIMS Hospital");
        listDataHeader.add("Krishna Shalby Hospital");
        listDataHeader.add("Civil Hospital");

        List<String> zydus=new ArrayList<>();
        zydus.add("Phone number : 9995559991");

        List<String> cims=new ArrayList<>();
        cims.add("Phone number : 5551111222");

        List<String> shalby=new ArrayList<>();
        shalby.add("Phone number : 8885559991");

        List<String> sal=new ArrayList<>();
        sal.add("Phone number : 5557777222");

        listHash.put(listDataHeader.get(0),zydus);
        listHash.put(listDataHeader.get(1),cims);
        listHash.put(listDataHeader.get(2),shalby);
        listHash.put(listDataHeader.get(3),sal);
    }
}
