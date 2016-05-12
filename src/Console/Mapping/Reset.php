<?php

namespace Sleimanx2\Plastic\Console\Mapping;

use Illuminate\Console\Command;
use Sleimanx2\Plastic\Mappings\Mappings;

class Reset extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'mapping:reset {--database=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "remove all mapping log from the repository";

    /**
     * @var Mappings
     */
    private $mappings;


    /**
     * Reset constructor
     *
     * @param Mappings $mappings
     */
    public function __construct(Mappings $mappings)
    {
        parent::__construct();

        $this->mappings = $mappings;
    }

    /**
     * Execute the console command
     */
    public function handle()
    {
        if (! $this->confirm('Resetting mappings will delete all mapping logs continue ? [y|N]')) {
            return;
        }

        $this->mappings->setSource($this->option('database'));

        $this->mappings->reset();

        $this->comment('Mapping repository reset successfully');
    }
}