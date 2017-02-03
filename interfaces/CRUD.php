<?php
interface CRUD {
    function create();
    function read($id);
    function update($id);
    function delete($id);
}

?>