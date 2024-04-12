<?php

use Livewire\Volt\Volt;

Volt::route('/admin/login', 'admin.login.index');
Volt::route('/admin/logout', 'admin.logout.index');
Volt::route('/admin/users/list', 'admin.users.list.index');
Volt::route('/admin/users/communication', 'admin.users.communication.index');