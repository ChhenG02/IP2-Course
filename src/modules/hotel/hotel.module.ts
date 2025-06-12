// src/modules/hotel/hotel.module.ts
import { Module } from '@nestjs/common';
import { HotelResolver } from './hotel.resolver';
import { HotelService } from './hotel.service';

@Module({
  providers: [HotelResolver, HotelService],
})
export class HotelModule {}