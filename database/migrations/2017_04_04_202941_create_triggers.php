<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER before_gqe_results_update
                BEFORE UPDATE ON gqe_results
                FOR EACH ROW
            BEGIN
                SET NEW.pass_level_id = (SELECT IF(NEW.score >= o.cutoff_phd,
                                                    3,
                                                    IF(NEW.score >= o.cutoff_ms,
                                                       2,
                                                       IF(NEW.score IS NOT NULL,
                                                          1,
                                                          NULL)))
                                        FROM gqe_offerings AS o WHERE o.id = NEW.offer_id);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER before_gqe_results_insert
                BEFORE INSERT ON gqe_results
                FOR EACH ROW
            BEGIN
                SET NEW.pass_level_id = (SELECT IF(NEW.score >= o.cutoff_phd,
                                                    3,
                                                    IF(NEW.score >= o.cutoff_ms,
                                                       2,
                                                       IF(NEW.score IS NOT NULL,
                                                          1,
                                                          NULL)))
                                        FROM gqe_offerings AS o WHERE o.id = NEW.offer_id);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER after_gqe_offerings_update
                AFTER UPDATE ON gqe_offerings
                FOR EACH ROW
            BEGIN
                UPDATE gqe_results SET pass_level_id = 1 WHERE gqe_results.offer_id = NEW.id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER before_gqe_results_update');
        DB::unprepared('DROP TRIGGER before_gqe_results_insert');
        DB::unprepared('DROP TRIGGER after_gqe_offerings_update');
    }
}
