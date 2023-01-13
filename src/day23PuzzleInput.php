<?php

$s1 = "
....#..
..###.#
#...#.#
.#...##
#.###..
##.#.##
.#..#..
";

$s2 = "
.....
..##.
..#..
.....
..##.
.....
";

$s1 = "
.#..####.........##...##...#.#.#.##..##.....##.##.##...#..##..#.###...
..######..####..##.#...####.#...#..####..#.#....#..#.#...#........#.#.
.#####.###.#...##....##..........##.###.#....#.##.####..#.#..#.##..#.#
#.#..#.###.##.#..##.#####...##...####..#.....###.##..#....##.#......#.
##.##.##....###....####.##.#....##.##.###..##..##...#.#...#..#.###.##.
....#.######....#..#....#.##.#.##..##.#.##...###..####....#.####.####.
.#..#..#.#.##.#...#.###...##..##...##...#.##...##..#.#..##.#..#...##.#
.###.#...#.#..#...####..#.##....#.####.##..##.#..###..###..#...####..#
..##....#....#..##...###..#.#..####...#..####.....#.###...###..##..#..
.#######.#.#.##.##.##.###.#.#.#.#.####.#..#..##...#.##.##.##..#.....#.
..##.##....#####.#.#######....#...###...#...#######.#..##....#..#####.
##.#.#.#.###.#.#..##...#..###.######..##.##.#..##....#.##.#...#.####..
.##.....#.####.##...#.########.##.###.##.....#.####.....##.......#.###
#.....##...#####.#.##..#######...###.####....#.#..##..####......#..#.#
#####....#..####..######...#..####.#..#.##...#######..#.#..###....##.#
.##.###..#.##...###..#..#.####.....##...#####.....##..#..#.#....###..#
..##...####.##.######.....#....##...##.#...#.##.#.......##.#..#####.#.
...##.#.###..#...#########.##.#..####.#.#.#.###.#.#.#..#.#.##.#..#.#..
.#.##..#.#.###.###.#...#.#..##.#.##.##...###....#######......#..##...#
##...##.#..#...#..#...###.##......##..#.###.......#..######.##...##.#.
.#..#.########..#...##..###..#.....##.##...#..###.##..#..##.....##..##
...#.###...#.#...#.#..#.##.##.##....#..#..#.#.##...#..#..#.###...##.##
.##....###.#.#..#.#.###.#..#..#.......###.###....#######.....####...##
.#..####..###..##.##.#.#..#.....#.....###.######..##....###########..#
..####..###.#..#...###.#.###....#..#.#..##......####.##..#..####.#....
##.##.##.#..#.##...#......##.##..#..#.#..#.##....#.#..#.#...#.#.#.#...
...#..####.#.#..#....#.#.##....##.##..#....#..##..#.#.#.###.##.#.##...
....#.#.#.#..###.....###.#..###.#####.###.#...#..######...#...##.#..#.
#...########.#..##...##..#.##...#..#.##.....##..##.##.#.####.##..#..##
#.#####..##.##.##.###.#.###..#.#.##.###.#.#..###.#.#...#.###.#..#...#.
.#..######.####...##..###.####.#.###.#.....######.#..##..#.###.#..####
##.#..####...#.......####.##.#.######.#...#..#.####.#.......#......###
..##...####...#.#######..####.##..##.........#.##.#..##...##..##.....#
.#..#####.#...#.#..##.###....##.##...##......#..#.##..#.#.#..#.##.####
.#.####.#.##.#####...#..##...###.#.#..#...#..#.##.......###...#...##..
....#....###..##....####.##...##.#.##.#.##.##.#.......#..#.##.####.##.
###.###.#.###.##.......##.###....#...##.....#.#......##.#.###.#....#.#
#...#...#..#.##.##.#..#..####..##.......#.#.#######.##..###..###.#.#..
...###.###..###.##.#.##.#.####.#..#.##..#####..##...####.#.#.#.#...#..
..#...##.#.....####.##....#...#.#..#.#..##..##..#####..##.###...#.###.
#.#...#...#.#..####..####...#....##...#.........##...#####.#.####.###.
#..###.....##..#..##......#.##...####..###...####...#.#....#....#....#
.#...##.##..#.#...#.#.#.##.####.#....#####..#...#####.#.....###..#.##.
###..#....##..##....##..#..##...##...#.##.####.####..#..#....#...###.#
.#.#.##..###.#..###..####..######.#...#####.#...####.#..##.##.......##
..#..##....##.#.###.#..##..#.#####...###...#.#.##.#.###..##.######..##
###.##.#.#....#..#..##.#.#.##..###..##...#...###..#..#######..#.##.#.#
#.#..#...#..###.##.##.#####...####.#.#....#...#....#.###.#..###.##....
##..###.#..#.##.######..##.#.#.....###.#..#..##...#.#..####.##.#.###.#
#.#..##.#.#.#####.###.###.#.#.##.###.....###.#.#..####.##.##..#.##..#.
###.#####..######..###.##.#.#.####....#..#..#.#.#..#.#..##.......##.#.
#..#....#.#..###.#.##.##..#..#.#.#.###..#...##..###.#....###..#....#..
.#.##.#.####...##...#.####..##.#.##.#...####.##...#....##.#..##.....##
#...###....######.##.....####.#.#.#..#..##..#..###.#####..###...#...#.
#.##...#.###.##.##.####.##.###..##..#...##....#.#..###..##....#####.##
#...########..##.#.##.##.####..#.###..##...##.#.#...#.####.#..###.#..#
.#.#....###...####.####.....###.##.#.#...#..#.#.#.##.....#.###......##
.###....#....#.#.##..#....#.##......#.#.##....##.##...###.#.#.##.....#
.........#..#.#..###..##...###.....###..##....###..#.#...##..#.###..#.
#.####.##....#...#.#.##.####.#.#.#....##....#.########.....##...#.##..
.#....#.###...###..#..#..#......##.##..#.###.#.######...##.##....#....
#..##.##..#.#.#.##.#..###.#..#######.#.#..#...##....#..###.#....##.##.
#.#..####..#.###..####....###.###..#.###.##...##...#.####..####...#.#.
#.##.###.###.##.##.#....#..#.##.#..##.#.##..##.###..#.#.####.#..###...
#.#####.#...##.#..##.###.####..####.#..##.#.......#......#.#.##..#.##.
##.##..#..###.#.##....#..###..###.##.####.###.####.#..###..#..####.###
#..##.####.#..#######..#..#....#..#####..#.#......#.####.#..#...#..##.
.##.#####....#.#.#..###.##..##.#..#.###..##....#....####...#.####.#..#
#.#..##.##..#####...##.#.#####..#.###..#...##..##.##.####.##.##.###.#.
#.####..#...#.###.#...#.######..###.####.#....##..#..##.###.#..#......
";
