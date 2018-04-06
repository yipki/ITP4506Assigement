package com.example.aaddr.test03;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;

public class createTodoList extends AppCompatActivity {

    Button btn_DailyWork, btn_Shopping;
    ImageView im_DailyWork, im_Shopping;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_todo_list);

        btn_DailyWork = (Button)findViewById(R.id.btn_DailyWork);
        btn_Shopping = (Button)findViewById(R.id.btn_Shopping);

        im_DailyWork = (ImageView)findViewById(R.id.im_DailyWork);
        im_Shopping = (ImageView)findViewById(R.id.im_Shopping);


        btn_DailyWork.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {
                Intent intent = new Intent(createTodoList.this, dailyworkTodoList.class);
                createTodoList.this.startActivity(intent);
            }
        });

        btn_Shopping.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {
                Intent intent = new Intent(createTodoList.this, shoppingTodoList.class);
                createTodoList.this.startActivity(intent);
            }
        });
    }

}
