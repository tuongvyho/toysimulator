Coding Challenge - Toy Robot Simulator

#### Environment Details

---------------------------------------------------------------------------------------------------------------
PHP 5.6.24 (cli) (built: Jul 20 2016 21:19:29)
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies

---------------------------------------------------------------------------------------------------------------
curl 7.50.0 (x86_64-pc-win32) libcurl/7.50.0 OpenSSL/1.0.2h nghttp2/1.13.0
Protocols: dict file ftp ftps gopher http https imap imaps ldap pop3 pop3s rtsp smb smbs smtp smtps telnet tftp
Features: AsynchDNS IPv6 Largefile NTLM SSL HTTP2

---------------------------------------------------------------------------------------------------------------
Codeception version 1.8.0.1

#### Assumptions

All tests and movement are based on a 5x5 tabletop surface.

#### Instructions

To run the script in cli:


1. Download and extract the code or clone from repo to the folder of your choice.
2. In command line (WINDOWS: administrator rights, path to PHP and curl) go to the folder you have extracted the project too. 
3. Run-> php toyRobotSim.php testfiles/file-1 [testdata/file-2  testdata/file-n] Minimum of 1 file, up to n number of files.

Various files for you have been provided under testfiles folder but you are welcome to generate your own.

- php toyRobotSim.php testfiles/syntax-handling-test
- php toyRobotSim.php testfiles/edge-detection-another-placement
- php toyRobotSim.php testfiles/ignore-bad-commands
- php toyRobotSim.php testfiles/perimeter-test

Note: Windows has to use full paths with inverted comma to handle space's in your path.

Example: php toyRobotSim.php  "C:\Users\username\Desktop\coding-challenge-toy-robot-simulator\testfiles\perimeter-test"

To see examples of TDD unit tests with codeception:

Note: no functional or acceptance testing was done.

1. Ensure you have completed step 1 & step above
2. Make sure you have php and curl enabled with composer and ssl component enabled.
3. Run-> php codecept.phar run 