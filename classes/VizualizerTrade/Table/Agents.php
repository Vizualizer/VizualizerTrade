<?php

/**
 * Copyright (C) 2012 Vizualizer All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Naohisa Minagawa <info@vizualizer.jp>
 * @copyright Copyright (c) 2010, Vizualizer
 * @license http://www.apache.org/licenses/LICENSE-2.0.html Apache License, Version 2.0
 * @since PHP 5.3
 * @version   1.0.0
 */

/**
 * trade_agentsテーブルの定義クラスです。
 *
 * @package VizualizerTrade
 * @author Naohisa Minagawa <info@vizualizer.jp>
 */
class VizualizerTrade_Table_Agents extends Vizualizer_Plugin_Table
{

    /**
     * コンストラクタです。
     */
    public function __construct()
    {
        parent::__construct("trade_agents", "trade");
    }

    /**
     * テーブルを作成するためのスタティックメソッドです。。
     */
    public static function install()
    {
        $connection = Vizualizer_Database_Factory::begin("trade");
        try {
            // 依存テーブルをインストール
            VizualizerTrade_Table_AgentOperators::install();

            // テーブルのインストール
            $connection->query(file_get_contents(dirname(__FILE__) . "/../../../sqls/agents.sql"));
            Vizualizer_Database_Factory::commit($connection);
        } catch (Exception $e) {
            Vizualizer_Database_Factory::rollback($connection);
        }
    }
}
