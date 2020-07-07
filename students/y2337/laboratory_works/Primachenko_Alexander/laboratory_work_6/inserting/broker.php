<!DOCTYPE html>
<html>
    <head>
        <title>BDBD Lab 6</title>
        <meta http-equiv="Content Type" content="text/html;charset=UNICODE" />
    </head>
    <body>

	<h2>Добавить запись в таблицу Брокер</h2>
	<form action="../index.html">
		<button type = "submit"><-- Назад на главную</button>
	</form>
	<br>

    <h3>Введите данные:</h3>
    <form name="insert" action="broker.php" method="POST">
    Введите id:<br>
    <input type="text" name="id"/><br>
    Введите name:<br>
	<input type="text" name="name"/><br>
	Введите bureu_id:<br>
	<input type="text" name="bureu_id"/><br>
	Введите percent:<br>
    <input type="text" name="percent"/><br>
    <button type = "submit">Добавить запись</button>
    </form>
    <br>
    <?php
        $host = 'host=localhost';
        $dbname= 'dbname=Birzha';
        $dbuser = 'user=postgres';
        $dbpass = 'password=123456';
        $db = pg_connect("$host $dbname $dbuser $dbpass");


        if($_POST != NULL)
        {
            if($result = pg_insert($db, 'Broker', $_POST))
                echo 'Вы что-то добавили!';
            else
                echo 'Произошла ошибка!';
            $_POST = NULL;
        }

        //Вывод всех значений
        echo '<h3>Все данные из таблицы:</h3>';
		$query = 'select * from public."Broker" order by id asc';
		$result = pg_query($db, $query);
		echo '<table border=1>';
		echo '<tr>';
		for ($i=0; $i<pg_num_fields($result); $i++) {
			echo '<td>' . pg_field_name($result, $i) . '</td>';
		}
		echo '</tr>';
		while ($row = pg_fetch_row($result)) {
			echo '<tr>';
			foreach ($row as $field) {
				echo '<td>' . $field . '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
		//Конец вывода всех значений

		pg_close($db);
    ?>
    </body>
</html>