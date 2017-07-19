<?php

class OmahaEventResultTypes
{
    const UNKNOWN = 0;
    // The result when no update is available.
    const NO_UPDATE = 1;
    // The result when a new update is available.
    const AVAILABLE = 2;
    // Operation success.
    const SUCCESS = 3;
    // Success and app restarted.
    const SUCCESS_RESTARTED = 4;
    // Operation failed.
    const ERROR = 5;
    // Operation cancelled.
    const CANCELLED = 6;
    // Operation started.
    const STARTED = 7;
}
