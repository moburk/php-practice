<?php

function throw_exception()
{
    throw new Exception("Exception!");
}

try {
    throw_exception();
} catch (Exception $e) {
    print("Exception caught! ");
} finally {
    print("Done!");
}