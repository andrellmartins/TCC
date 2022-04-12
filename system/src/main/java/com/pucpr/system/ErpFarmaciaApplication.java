package com.pucpr.system;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.autoconfigure.domain.EntityScan;

@SpringBootApplication
@EntityScan(basePackages = { "com.pucpr.system" })
public class ErpFarmaciaApplication {

	public static void main(String[] args) {

		SpringApplication.run(ErpFarmaciaApplication.class, args);
	}


}
