<?php

declare(strict_types=1);

function taintFindings(): array
{
    static $findings;

    if ($findings === null) {
        exec('vendor/bin/psalm --config=tests/psalm.xml --no-cache --no-progress --output-format=json 2>/dev/null', $output);

        $findings = [];
        foreach (json_decode(implode('', $output), true, flags: JSON_THROW_ON_ERROR) as $issue) {
            if (str_starts_with($issue['type'], 'Tainted')) {
                $findings[basename($issue['file_name'])][] = $issue['type'];
            }
        }
    }

    return $findings;
}

it('reports untrusted input that reaches a sink', function (string $fixture, string $type, int $count) {
    expect(taintFindings()[$fixture] ?? [])->toBe(array_fill(0, $count, $type));
})->with([
    'listing conditions'       => ['Listing.php', 'TaintedSql', 2],
    'serialized data'          => ['Serialize.php', 'TaintedUnserialize', 1],
    'DBAL queries'             => ['Connection.php', 'TaintedSql', 9],
    'query builder conditions' => ['QueryBuilder.php', 'TaintedSql', 6],
]);

it('accepts untrusted input bound as a parameter', function () {
    expect(taintFindings())->not->toHaveKey('Parameters.php');
});
