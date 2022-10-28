<?php
    namespace DB;
    
    abstract class QueryType
    {
        const Query = 0;                      // SQL plano
        const StoredProcedure = 1;            
    }
?>