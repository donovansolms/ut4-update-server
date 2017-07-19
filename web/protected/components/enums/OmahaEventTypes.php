<?php

class OmahaEventTypes
{
    const UNKNOWN = 0;
    // The event type to submit to check for update.
    const UPDATE_CHECK = 1;
    // Event type for results regarding downloads.
    const UPDATE_DOWNLOAD = 2;
    // Event type for results regarding installation.
    const UPDATE_INSTALL = 3;
    // Event type for results regarding rollback.
    const UPDATE_ROLLBACK = 4;
    // Event type for ping tests.
    const PING = 800;
}
