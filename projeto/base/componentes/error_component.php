<?php
class error_component{
    public function __construct($error_number, $error_message, $error_filename, $error_line, $error_context){
        $this->error_number   = $error_number;
        $this->error_message  = $error_message;
        $this->error_filename = $error_filename;
        $this->error_line     = $error_line;
        $this->error_context  = $error_context;
    }
    public function showFullMessage(){

        $html = $this->getMainMessage();
        $html .= $this->getTraceLines();
        interfacePadrao::render_args($html);
    }

    public function getMainMessage(){
        return "
    <table>
        <thead>
            <tr>
                <th>error_number</th>
                <th>{$this->error_number}</th>
            </tr>
            <tr>
                <th>error_message</th>
                <th>{$this->error_message}</th>
            </tr>
            <tr>
                <th>error_filename</th>
                <th>{$this->error_filename}</th>
            </tr>
            <tr>
                <th>error_line</th>
                <th>{$this->error_line}</th>
            </tr>
            <tr>
                <th>error_context</th>
                <th><textarea style=\"resize:both;white-space:pre;\">".print_r($this->error_context,true)."</textarea></th>
            </tr>
        </thead>
    </table>
";
    }

    public function getTraceLines(){
        $trace = array_reverse(debug_backtrace());

        $traceLines = '
        <table>
            <thead>
                <tr>
                    <th>function </th>
                    <th>line     </th>
                    <th>file     </th>
                    <th>class    </th>
                    <th>object   </th>
                    <th>type     </th>
                    <th>args     </th>
                </tr>
            </thead>
            <tbody>
        ';

                foreach($trace as $row){
                    $row['function'] = $row['function'] ?? 'function empty';
                    $row['line'] = $row['line'] ?? 'line empty';
                    $row['file'] = $row['file'] ?? 'file empty';
                    $row['class'] = $row['class'] ?? 'class empty';
                    $row['object'] = $row['object'] ?? 'object empty';
                    $row['type'] = $row['type'] ?? 'type empty';
                    $row['argss'] = $row['argss'] ?? 'argss empty';
                    $traceLines .= "
        <tr>
            <td>{$row['function']}</td>
            <td>{$row['line']}</td>
            <td>{$row['file']}</td>
            <td>{$row['class']}</td>
            <td><textarea style=\"resize:both;white-space:pre;\">".print_r($row['object'],true)."</textarea></td>
            <td>{$row['type']}</td>
            <td><textarea style=\"resize:both;white-space:pre;\">".print_r($row['args'],true).'</textarea></td>
        </tr>
        ';
                }
        $traceLines.='
            </tbody>
        </table>
        ';
        return $traceLines;
    }
}