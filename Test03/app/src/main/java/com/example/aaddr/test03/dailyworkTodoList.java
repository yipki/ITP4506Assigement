package com.example.aaddr.test03;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

public class dailyworkTodoList extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dailywork_todo_list);

        Spinner sp_dwCategory = findViewById(R.id.sp_dwCategory);
        Spinner sp_importance = findViewById(R.id.sp_importance);

        ArrayAdapter<CharSequence> adapter_category = ArrayAdapter.createFromResource(this, R.array.DailyWork_category, android.R.layout.simple_spinner_item);
        adapter_category.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp_dwCategory.setAdapter(adapter_category);

        ArrayAdapter<CharSequence> adapter_importance = ArrayAdapter.createFromResource(this, R.array.Importance, android.R.layout.simple_spinner_item);
        adapter_category.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        sp_importance.setAdapter(adapter_importance);

    }
}
