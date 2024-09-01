<?php

declare(strict_types=1);

namespace Testcontainers\Container;

use Testcontainers\Wait\WaitForHttp;

class OpenSearchContainer extends GenericContainer
{
    public function __construct(string $version = 'latest')
    {
        parent::__construct('opensearchproject/opensearch:' . $version);
        $this->withExposedPorts(9200);
        $this->withEnvironment('discovery.type', 'single-node');
        $this->withEnvironment('OPENSEARCH_INITIAL_ADMIN_PASSWORD', 'c3o_ZPHo!');
        $this->withWait(WaitForHttp::make(9200));
    }

    /**
     *  @deprecated Use constructor instead
     *  Left for backward compatibility
     */
    public static function make(string $version = 'latest'): self
    {
        return new self($version);
    }

    public function withDisabledSecurityPlugin(): self
    {
        $this->withEnvironment('plugins.security.disabled', 'true');

        return $this;
    }

    /**
     * @deprecated Use withDisabledSecurityPlugin instead
     */
    public function disableSecurityPlugin(): self
    {
        return $this->withDisabledSecurityPlugin();
    }
}
