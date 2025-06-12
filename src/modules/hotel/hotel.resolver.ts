// src/modules/hotel/hotel.resolver.ts
import { Args, Mutation, Query, Resolver } from '@nestjs/graphql';
import { HotelService, Hotel } from './hotel.service';

@Resolver('Hotel')
export class HotelResolver {
  constructor(private readonly hotelService: HotelService) {}

  @Query('hotels')
  getAllHotels() {
    return this.hotelService.findAll();
  }

  @Query('hotel')
  getHotelById(@Args('id') id: string) {
    return this.hotelService.findOne(Number(id));
  }

  @Mutation('createHotel')
  createHotel(
    @Args('name') name: string,
    @Args('address') address: string,
    @Args('phone') phone: string,
  ) {
    return this.hotelService.create(name, address, phone);
  }

  @Mutation('updateHotel')
  updateHotel(
    @Args('id') id: string,
    @Args('name', { nullable: true }) name: string,
    @Args('address', { nullable: true }) address: string,
    @Args('phone', { nullable: true }) phone: string,
  ) {
    return this.hotelService.update(Number(id), name, address, phone);
  }

  @Mutation('deleteHotel')
  deleteHotel(@Args('id') id: string) {
    return this.hotelService.remove(Number(id));
  }
}