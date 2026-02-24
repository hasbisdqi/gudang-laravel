<?php

namespace App;

enum TransactionType: string
{
    case INCOMING = 'incoming';
    case OUTGOING = 'outgoing';
}
