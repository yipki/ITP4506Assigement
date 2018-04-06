package com.example.aaddr.test03;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

import java.util.Locale;

public class shoppingTodoList extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        loadLocale();
        setContentView(R.layout.activity_shopping_todo_list);

        android.support.v7.app.ActionBar actionBar = getSupportActionBar();
        actionBar.setTitle(getResources().getString(R.string.app_name));

        Spinner sp_shCategry = findViewById(R.id.sp_dwCategory);
        Spinner sp_importance = findViewById(R.id.sp_importance);

        ArrayAdapter<CharSequence> adapter_category = ArrayAdapter.createFromResource(this, R.array.Shopping_category, android.R.layout.simple_spinner_item);
        adapter_category.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp_shCategry.setAdapter(adapter_category);

        ArrayAdapter<CharSequence> adapter_importance = ArrayAdapter.createFromResource(this, R.array.Importance, android.R.layout.simple_spinner_item);
        adapter_importance.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp_importance.setAdapter(adapter_importance);

        Button btn_lan = (Button)findViewById(R.id.btn_lan);
        btn_lan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDialog();
            }
        });
    }
    private void showDialog() {

        final String[] listItems = {"English","Indonesia","Filipino"};
        AlertDialog.Builder mBuilder = new AlertDialog.Builder(shoppingTodoList.this);
        mBuilder.setTitle("Choose Language..");
        mBuilder.setSingleChoiceItems(listItems, -1, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                if (i==0) {
                    setLacale("en");
                    recreate();
                }
                else if (i==1) {
                    setLacale("in");
                    recreate();
                }
                else if (i==2) {
                    setLacale("tl");
                    recreate();
                }
                dialogInterface.dismiss();
            }
        });
        AlertDialog mDialog = mBuilder.create();

        mDialog.show();
    }

    private void setLacale(String lan) {
        Locale locale = new Locale(lan);
        Locale.setDefault(locale);
        Configuration config = new Configuration();
        config.locale = locale;
        getBaseContext().getResources().updateConfiguration(config, getBaseContext().getResources().getDisplayMetrics());


        SharedPreferences.Editor editor = getSharedPreferences("Settings", MODE_PRIVATE).edit();
        editor.putString("My_lan", lan);
        editor.apply();

    }
    public void loadLocale() {
        SharedPreferences prefs = getSharedPreferences("Settings", Activity.MODE_PRIVATE);
        String language = prefs.getString("My_lan","");
        setLacale(language);
    }
}
