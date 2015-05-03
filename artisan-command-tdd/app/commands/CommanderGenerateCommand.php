<?php

use Acme\Console\CommandGenerator;
use Acme\Console\CommandInputParser;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CommanderGenerateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'commander:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate command and handler classes.';

    /**
     * @var CommandInputParser
     */
    private $parser;

    /**
     * @var CommandGenerator
     */
    private $generator;

    /**
     * Create a new command instance.
     *
     * @param CommandInputParser $parser
     */
	public function __construct(CommandInputParser $parser, CommandGenerator $generator)
	{
		parent::__construct();

        $this->parser = $parser;
        $this->generator = $generator;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        // Parse the input for the Artisan command into a usable format.
		$input = $this->parser->parse(
            $this->argument('path'),
            $this->option('properties')
        );

        // Actually create the file with the correct boilerplate.
        $this->generator->make(
            $input,
            app_path('commands/templates/command.template'),
            $this->getClassPath()
        );

        $this->info('All done!');
	}

    private function getClassPath()
    {
        return $this->option('base') . '/' . $this->argument('path') . '.php';
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('path', InputArgument::REQUIRED, 'Path to the command class to generate.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('properties', null, InputOption::VALUE_OPTIONAL, 'List of properties to build.', null),
			array('base', null, InputOption::VALUE_OPTIONAL, 'The base directory to begin from.', app_path())
		);
	}

}
