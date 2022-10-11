package com.example.hplaptop.icuonwheels;

import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatDialogFragment;
import android.telephony.SmsManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;


public class MsgDialog extends AppCompatDialogFragment {
    EditText phno;
    MsgDialogListener listener;
    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        AlertDialog.Builder builder=new AlertDialog.Builder(getActivity());
        LayoutInflater inflater=getActivity().getLayoutInflater();
        View view=inflater.inflate(R.layout.layout_dialog,null);

        builder.setView(view)
                .setTitle("Enter phone number")
                .setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                         String phone=phno.getText().toString();
                         listener.applyTexts(phone);
                    }
                });

        phno=view.findViewById(R.id.edit_username);
        return builder.create();
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        try{
            listener=(MsgDialogListener) context;
        }
        catch (ClassCastException e){
            throw new ClassCastException(context.toString()+"Must implement MsgDialogListener");
        }
    }

    public interface MsgDialogListener{
        void applyTexts(String username);
    }
}
