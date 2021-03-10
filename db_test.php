<?php 
    //include "salmonela.php";

    /*
    * Connection values. It's best to get them 
    * from an external (secured) file.
    */

    $db_connection = NULL;
    $db_statement = NULL;
    $sql_string = '';
    $download_result_set = NULL;
    $download_result_row = NULL;
    $download_result_columns = NULL;
    $download_result_sum = 0;

    $connection_host = '';
    $connection_database = '';
    $connection_user = '';
    $connection_password = '';
    
    /* 
    * Concatenate the host and database 
    * name into a Data Source Name (DSN)
    * the PDO constructor will accept.
    */
    $connection_dsn = 'msql:dbname='.$connection_database.';host='.$connection_host;
    
    /*
    * Creates a PDO instance and establishes
    * connection to database. If the connection
    * fails, we catch the exception and output
    * reason.
    */
    try 
    {
        $db_connection = new pdo($connection_dsn, $connection_user, $connection_password);
    } 
    catch (PDOException $e) 
    {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
    /*
    * Concatenate a SQL string. Only ask for 
    * the columns * you need. Using * is just 
    * extra load on the server for nothing.
    */
    
    $sql_string = 'SELECT title, download_count FROM ahm_files ORDER BY download_count DESC LIMIT 30';
    
    /*
    * If we have a good connection, we attempt 
    * to execute the query. If all goes well, it 
    * will establishe a PDO statement object which 
    * we can use to get the column values.
    */
    if($db_connection)
    {    
        try 
        {
            $db_statement = $db_connection->query($sql_string);

            /* 
            * I really prefer to set up a data class 
            * and populate it with fetchObject(). It's
            * much more organized and lets us separate
            * code from markup, but requires time that 
            * wasn't available.
            *
            * We'll have to fetch the columns into an 
            * array instead. It's a little quick and 
            * dirty, but it's a common technique and
            * will serve our purposes. :)
            */

            $download_result_set = $db_statement->fetchAll();
        }
        catch (PDOException $e) 
        {
            echo 'Statement or fetch failed: '.$e->getMessage();
        }

        /*
        * Let's query for the total number of downloads.
        * We can use the same connection.
        */

        $sql_string = 'SELECT sum(download_count) AS download_total FROM ahm_files';

        /*
        * Now we attempt to execute the query. If
        * all goes well, it will establishe a PDO 
        * statement object which we can use to get 
        * the column values.       
        */
        try 
        {
            $db_statement = $db_connection->query($sql_string);       

            /*
            * There's only row and one column, so
            * we can just use the fetchColumn()
            * function. It's limited but very
            * fast.
            */

            $download_result_sum = $db_statement->fetchColumm();
        }
        catch (PDOException $e) 
        {
            echo 'Statement or fetch failed: '.$e->getMessage();
        }

        ?>

        <table width="100%" border="1">
        <thead>
            <tr>
               <th>Name</th>
               <th>Downloads</th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
        <?php
        foreach ($download_result_set as $download_result_row => $download_result_columns) 
        {
        ?>
            <tr style="color: #FFF; border: thin solid #fff !important;">
              <td><?php echo $download_result_columns['title']; ?></td>
              <td><?php echo number_format($download_result_columns['download_count'],0,'','.'); ?></td>
            </tr>      
        <?php
        }
        ?>
        </table>

        <!-- 
        -- I moved the sum out of table.
        --
        -- As a rule non-columnar information 
        -- shouldn't ever be inside of a table. 
        -- It's non-compliant and some broswers 
        -- will do odd things or complain.
        -->
        <span style="font-weight: bold">Total downloads:</span><br />
        <?php echo $download_result_sum; 
    }
?>