<?php

namespace Sikessem\View;

use Illuminate\View\Compilers\BladeCompiler;
use Sikessem\View\Contracts\IsTemplateCompiler;

class TemplateCompiler extends BladeCompiler implements IsTemplateCompiler {}
