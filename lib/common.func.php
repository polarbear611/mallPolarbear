<?php
    function alertMessage($message, $url)
    {
        echo "<script>alert('{$message}');</script>";
        echo "<script>window.location='{$url}';</script>";
	}
?>