<?php

class Counter
{
    /**
     * Iterates over all directories recursively starting from $path
     * and returns the sum of the numbers in the files $fileName
     *
     * @param string $path
     * @param string $fileName
     * @return int
     * @throws Exception
     */
    public function getTotalSum(string $path, string $fileName): int
    {
        $count = 0;
        $rDirIterator = new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS);
        $rIterator = new \RecursiveIteratorIterator($rDirIterator);
        /**
         * @var \SplFileInfo $fileInfo
         */
        foreach ($rIterator as $pathName => $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getFilename() === $fileName) {
                $count += $this->getCountFromFile($pathName);
            }
        }

        return $count;
    }

    /**
     * Returns number from the file $filePath
     *
     * @param string $filePath
     * @return int
     * @throws Exception
     */
    private function getCountFromFile(string $filePath): int
    {
        $count = @file_get_contents($filePath);
        if ($count === false) {
            $error = \error_get_last();
            $message = $error['message'] ?? 'Unknown error';
            throw new \Exception("Could not read file '$filePath': $message");
        }
        $count = trim($count);

        if (!is_numeric($count)) {
            throw new \Exception("Invalid value '$count' in the file '$filePath'");
        }

        return intval($count);
    }
}
