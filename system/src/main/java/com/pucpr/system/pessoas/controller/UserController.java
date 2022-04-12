package com.pucpr.system.pessoas.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.Mapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/")
public class UserController {
    @RequestMapping("/")
    public String getLoginHTML(){
        return "/pessoas/html/login.html";
    }

    @RequestMapping("requestCSS/{path}")
    public String getCSSFiles(@PathVariable String path){
        return path;
    }


}
