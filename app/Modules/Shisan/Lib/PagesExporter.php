<?php

use \Illuminate\Filesystem\Filesystem;

/**
 * PagesExporter exports pages into a php array.
 */
class PagesExporter {

    /**
     * The pages repository.
     *
     * @var Page
     */
    protected $pages;

    /**
     * The filesystem.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct(Page $pages, Filesystem $filesystem)
    {
        $this->pages = $pages;
        $this->filesystem = $filesystem;
    }

    /**
     * Export pages into specified file as a php array.
     *
     * @param  string $path
     *
     * @return boolean
     */
    public function export($path)
    {
        $pages = $this->pages->defaultOrder()->get()->toTree()->toArray();

        $contents = '<?php return '.var_export($pages, true).';';

        return $this->filesystem->put($path, $contents) !== false;
    }

    /**
     * Get the mime type for the exported file.
     *
     * @return string
     */
    public function getMimeType()
    {
        return 'application/x-php';
    }

    /**
     * Get the extension for the exported file.
     *
     * @return string
     */
    public function getExtension()
    {
        return 'php';
    }
}
